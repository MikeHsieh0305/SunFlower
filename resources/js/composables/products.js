import {ref} from 'vue';
import axios from 'axios';
import { routerKey } from 'vue-router';
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2'
import { result } from 'lodash';



export default function useProducts(){
    const products = ref([])
    const categories = ref([])
    const product = ref([])

    const router = useRouter()
    const errors = ref('')

    const getProducts = async () => {
        let response = await axios.get('/api/products/')
        products.value = response.data.data;
       
    }

    const getProduct = async (id) => {
        let response = await axios.get(`/api/products/${id}`)
        
        product.value = response.data.data;
        
    }
    const getCategroies = async () =>{
        let response = await axios.get('/api/categories/')
        categories.value = response.data.data;
    }

    const storeProduct = async (data) => {
        errors.value = ''
        try{
            await axios.post('/api/products/',data)
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

    const updateProduct = async (id) => {
        errors.value = ''
        try{
            await axios.patch(`/api/products/${id}`,product.value)
            await router.push({ name : 'home'})
        }catch(e){
            if(e.response.status === 422){
                for(const key in e.response.data.errors){
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const destoryProduct = async(id) => {
        await axios.delete(`/api/products/${id}`)
        // let i = this.products.map(data => data.id).indexOf(id);
        // this.products.splice(i, 1)

    }

    

    return {
        errors,
        products,
        product,
        categories,        
        getProducts,
        getProduct,
        storeProduct,
        updateProduct,
        destoryProduct,
        getCategroies,
    }
}