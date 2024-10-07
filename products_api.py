# products_api.py
from fastapi import APIRouter, HTTPException
from pydantic import BaseModel
from typing import List
from database import get_pool

# Create an APIRouter instance
router = APIRouter()

# Pydantic model for Product
class Product(BaseModel):
    product_name: str
    description: str = None
    price: float
    stock: int

# Endpoint to create a product
@router.post("/products/")
async def create_product(product: Product):
    pool = await get_pool()
    async with pool.acquire() as conn:
        async with conn.cursor() as cursor:
            await cursor.execute(
                "INSERT INTO products (product_name, description, price, stock) VALUES (%s, %s, %s, %s)",
                (product.product_name, product.description, product.price, product.stock)
            )
            await conn.commit()
    return {"message": "Product added successfully!"}

# Endpoint to read all products
@router.get("/products/", response_model=List[Product])
async def read_products():
    pool = await get_pool()
    async with pool.acquire() as conn:
        async with conn.cursor() as cursor:
            await cursor.execute("SELECT product_name, description, price, stock FROM products")
            result = await cursor.fetchall()
            products = [
                Product(
                    product_name=row[0],  # Adjust the index according to the SELECT query
                    description=row[1],
                    price=row[2],
                    stock=row[3]
                ) for row in result
            ]
    return products
