import {ref} from 'vue';
import axios from 'axios';
import { routerKey } from 'vue-router';
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2'



export default function useCategories(){
    
    const categories = ref([])
    const category = ref([])
    

    const router = useRouter()
    const errors = ref('')

    const getCategories = async () => {
        let response = await axios.get('/api/categories/')
        categories.value = response.data.data;
        //console.log(response.data)
    }

    const getCategory = async (id) => {
        let response = await axios.get(`/api/categories/${id}`)
        //console.log(response.data.data)
        category.value = response.data.data;
        //console.log(response.data.data)
    }
    
    const storeCategory = async (data) => {
        errors.value = ''
        try{
            await axios.post('/api/categories/',data)
            Swal.fire({  
                title: '產品新增成功',              
                icon: 'success',
            }).then((result)=>{
                router.push({ name : 'home' })
            })
            
        }catch(e){
            if(e.response.status === 422){
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const updateCategory = async (id) => {
        errors.value = ''
        try{
            await axios.patch(`/api/categories/${id}`,category.value)
            await router.push({ name : 'home'})
        }catch(e){
            if(e.response.status === 422){
                for(const key in e.response.data.errors){
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const destoryCategory = async(id) => {
        await axios.delete(`/api/categories/${id}`)
        // let i = this.products.map(data => data.id).indexOf(id);
        // this.products.splice(i, 1)

    }

    

    return {
        errors,
        categories,
        category,               
        getCategories,
        getCategory,
        storeCategory,
        updateCategory,
        destoryCategory,        
    }
}