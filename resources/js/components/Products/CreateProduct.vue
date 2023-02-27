<template>
    <div>
        <h3 class="text-center">Create Product</h3>
        <div class="row">
            <div class="col-md-6">
                <div v-if="errors">
                    <div v-for="(v, k) in errors" :key="k" class="">
                        <p v-for="error in v" :key="error" class="text-sm text-danger">
                            {{ error }}
                        </p>
                    </div>
                </div>
                <form @submit.prevent="saveProduct()"><!--"addProduct"-->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.Name">
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" class="form-control" v-model="product.Quantity">
                    </div>
                    <div class="form-group">
                        <label>Unit_Price</label>
                        <input type="text" class="form-control" v-model="product.Unit_Price">
                    </div>
                    <div class="form-group">
                        <label>ItemCategory</label>
                        <!-- <input type="text" class="form-control" v-model="product.ItemCategory">-->
                        <select v-model="product.ItemCategory" class="form-select" aria-label="Default select example">
                            <option v-for="list in categories" :value="list.id" >{{list.description}}</option>
                        </select>
                    </div>                    
                    <div class="form-group">
                        <label>remark</label>
                        <input type="text" class="form-control" v-model="product.remark">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script setup>
import Swal from 'sweetalert2';
import { reactive } from 'vue';
import useProducts from '../.././composables/products';
import { onMounted } from 'vue';

    //export default {
        // data() {
        //     return {
        //         product: {}
        //     }
        // },
        // methods: {
        //     addProduct() {
        //         this.axios
        //             .post('http://localhost:8000/api/products', this.product)
        //             .then(response => ( 
        //                 // alert(response.data),                     
        //                 this.$router.push({ name: 'home' })
        //             ))
        //             .catch(err => console.log(err))
        //             .finally(() => this.loading = false)
                
        //     }
        // }

       

            const product = reactive({
                'Name' :'',
                'Quantity' : '',
                'Unit_Price' : '',
                'ItemCategory' : '',
                'remark' : ''
            })

            const {errors,categories,storeProduct,getCategroies} = useProducts();

            onMounted(()=>{getCategroies()})

            const saveProduct = async() =>{
                
                await storeProduct({...product});
            }

            // return{
            //     product,
            //     errors,
            //     saveProduct
            // }

        
    //}
</script>