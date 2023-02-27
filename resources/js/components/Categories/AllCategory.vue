<template>
    <div>
        <h2 class="text-center">Category List</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <!-- <td><input type="checkbox" id="checkbox" v-model="checked"></td> -->
                    <td>{{ category.id }}</td>
                    <td>{{ category.Name }}</td>
                    <td>{{ category.description }}</td>                    
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{ name: 'category', params: { id: category.id } }"
                                class="btn btn-success">Edit</router-link>
                            <button class="btn btn-danger" @click="deleteCategory(category.id)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
import useCategories from '../../composables/categories'
import { onMounted } from 'vue'
import Swal from 'sweetalert2'
export default {
    
    setup() {
        const { categories, getCategories, destoryCategory } = useCategories()

        onMounted(getCategories)

        const deleteCategory = async (id) => {
            
            const result = await Swal.fire({
                
                text: "確定要刪除嗎？",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '確定',
                cancelButtonText: '取消',
            });
           
            if(result.value){
                await destoryCategory(id);
                await getCategories();
            }
            return           

        }

        return {            
            categories,
            deleteCategory
        }
    }

}
</script>