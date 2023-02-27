<template>
    <div>
        <h2 class="text-center">Product List</h2>

        <table class="table">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit_Price</th>
                    <th>ItemCategory</th>
                    <th>remark</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <!-- <td><input type="checkbox" id="checkbox" v-model="checked"></td> -->
                    <!-- <td>{{ product.id }}</td> -->
                    <td>{{ product.Name }}</td>
                    <td>{{ product.Quantity }}</td>
                    <td>{{ product.Unit_Price }}</td>
                    <td>{{ product.ItemCategory }}</td>
                    <td>{{ product.remark }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{ name: 'edit', params: { id: product.id } }"
                                class="btn btn-success">Edit</router-link>
                            <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
import useProducts from '../.././composables/products'
import { onMounted } from 'vue'
import Swal from 'sweetalert2'
export default {
    // data() {
    //     return {
    //         products: [],                
    //     }
    // },
    // created() {
    //     this.axios
    //         .get('http://localhost:8000/api/products/')
    //         .then(response => {
    //             this.products = response.data;
    //         });
    // },
    // methods: {
    //     deleteProduct(id) { 
    //         if(!window.confirm('Are you sure ?')){
    //             return  
    //         }
    //         this.axios
    //             .delete(`http://localhost:8000/api/products/${id}`)
    //             .then(response => {
    //                 let i = this.products.map(data => data.id).indexOf(id);
    //                 this.products.splice(i, 1)
    //             });
    //     }
    // }
    setup() {
        const { products, categories, getProducts, destoryProduct } = useProducts()

        onMounted(getProducts)

        const deleteProduct = async (id) => {
            
            const result = await Swal.fire({
                
                text: "確定要刪除嗎？",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '確定',
                cancelButtonText: '取消',
            });
           
            if(result.value){
                await destoryProduct(id);
                await getProducts();
            }
            return           

        }

        return {
            products,
            categories,
            deleteProduct
        }
    }

}
</script>