<template>
    <div class="container"> 
        <nav class="navbar navbar-expand-lg navbar-white bg-white">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/dashboard" class="nav-item nav-link">Products List</router-link>
                    <router-link to="/create" class="nav-item nav-link">Create Product</router-link>
                    <router-link to="/categories" class="nav-item nav-link">Categories List</router-link>
                    <router-link to="/category/create" class="nav-item nav-link">Create Category</router-link>
                    <!-- <router-link to="/create" class="nav-item nav-link">Excel</router-link> -->
                    <a href="/products/export/" class="nav-item nav-link" type="button">Excel</a>
                </div>
            </div>
        </nav>
        <router-view> </router-view>
    </div>
</template>
 
<script>
    export default {}
</script>