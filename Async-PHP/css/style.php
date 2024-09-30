<style>
/* styles.css */
body {
    display: flex;
    transition: margin-left 0.3s; /* Smooth transition */
}

.sidebar {
    width: 250px; /* Adjust the width of the sidebar */
    background-color: #f8f9fa;
    padding: 15px;
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    position: fixed; /* Fix sidebar position */
    height: 100vh; /* Full height */
    overflow-y: auto; /* Enable scrolling if needed */
    transition: transform 0.3s; /* Smooth transition for hiding */
}

.sidebar.hidden {
    transform: translateX(-100%); /* Move sidebar out of view */
}

.main-content {
    flex-grow: 1;
    padding: 20px;
    transition: margin-left 0.3s; /* Smooth transition for margin */
    margin-left: 250px; /* Default margin for sidebar */
}

.main-content.shifted {
    margin-left: 0; /* Shift content when sidebar is hidden */
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar {
        width: 200px; /* Adjust sidebar width on mobile */
    }
    .main-content {
        margin-left: 0; /* No margin when sidebar is hidden on mobile */
    }
}

.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}

</style>

