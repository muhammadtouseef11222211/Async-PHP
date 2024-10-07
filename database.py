# database.py
import aiomysql

async def get_pool():
    return await aiomysql.create_pool(
        host='mysql-26efb892-muhammadtou420-27e1.c.aivencloud.com',
        port=14786,
        user='avnadmin',
        password='AVNS_rIWbK0jA00JibIIZ1W1',
        db='test'  # Replace with your actual database name
    )
