<template>
    <div>
        <h3 class="text-center">Edit Product</h3>
        <div class="row">
            <div class="col-md-6">
                <div v-if="errors">
                    <div v-for="(v, k) in errors" :key="k" class="">
                        <p v-for="error in v" :key="error" class="text-sm text-danger">
                            {{ error }}
                        </p>
                    </div>
                </div>
                <form @submit.prevent="saveCategory">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="category.Name">
                    </div>
                    <div class="form-group">
                        <label>description</label>
                        <input type="text" class="form-control" v-model="category.description">
                    </div>
                    <!-- <div class="form-group">
                        <label>Unit_Price</label>
                        <input type="text" class="form-control" v-model="product.Unit_Price">
                    </div>
                    <div class="form-group">
                        <label>ItemCategory</label> -->
                        <!-- <input type="text" class="form-control" v-model="product.ItemCategory"> -->

                        <!-- <select v-model="product.ItemCategory" class="form-select" aria-label="Default select example">
                            <option v-for="list in categories" :value="list.id" >{{list.description}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>remark</label>
                        <input type="text" class="form-control" v-model="product.remark">
                    </div> -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script setup>

import useCategories from '../.././composables/categories'
import { onMounted } from 'vue';
    // export default {
    //     data() {
    //         return {
    //             product: {}
    //         }
    //     },
    //     created() {
    //         this.axios
    //             .get(`http://localhost:8000/api/products/${this.$route.params.id}`)
    //             .then((res) => {
    //                 this.product = res.data;
    //             });
    //     },
    //     methods: {
    //         updateProduct() {
    //             this.axios
    //                 .patch(`http://localhost:8000/api/products/${this.$route.params.id}`, this.product)
    //                 .then((res) => {
    //                     this.$router.push({ name: 'home' });
    //                 });
    //         }
    //     }
    // }

    const { errors, category, updateCategory, getCategory } = useCategories()

    const props = defineProps({
    id: {
        required: true,
        type: Number
    }
    })

    onMounted(() => {
        getCategory(props.id)        
    })

    const saveCategory = async() => {
        await updateCategory(props.id)
    }
    


</script>