import AllProduct from './components/Products/AllProduct.vue';
import CreateProduct from './components/Products/CreateProduct.vue';
import EditProduct from './components/Products/EditProduct.vue';
import AllCategory from './components/Categories/AllCategory.vue';
import EditCategory from './components/Categories/EditCategory.vue';
import CreateCategory from './components/Categories/CreateCategory.vue';


 
export const routes = [
    {
        name: 'home',
        path: '/dashboard',
        component: AllProduct
    },
    {
        name: 'create',
        path: '/create',
        component: CreateProduct
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditProduct,
        props: true
    },
    {
        name: 'categories',
        path: '/categories',
        component: AllCategory,
    },
    {
        name: 'category',
        path: '/category/edit/:id',
        component: EditCategory,
        props: true
    },
    {
        name: 'CateoryCreate',
        path: '/category/create',
        component: CreateCategory
    },
];