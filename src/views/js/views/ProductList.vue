<template>
    <div>
        <div class="d-flex justify-content-between">
            <h3> Product List </h3>

            <div>
                <button class="btn btn-outline-dark btn-sm rounded-lg mx-1">
                    <router-link class="text-decoration-none text-dark router-link" to="/add-product">Add</router-link>
                </button>
                <button class="btn btn-outline-dark btn-sm rounded-lg mx-1" @click="deleteAction"> Mass Delete </button>
            </div>
        </div>
        <hr class="my-3" />
        <div class="container">
            <div class="row g-4">
                <div class="col-3" v-for="(index,key) in products" :key="key">
                    <div class="border border-dark bg-light p-3">
                        <input type="checkbox" :id="`delete-${key}`" v-model="index.delete">
                        <div class="text-center p-1"> {{ index.sku }} </div>
                        <div class="text-center p-1"> {{ index.name }} </div>
                        <div class="text-center p-1"> {{ index.price + currency }} </div>
                        <div class="text-center p-1"> {{ determineType(index) }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            products: [],
            currency: "$",
        }
    },
    mounted() {
        this.getProducts();
    },
    methods: {
        deleteAction() {
            let isEmpty = Object.keys( this.products ).length === 0,
                deleteIds = [];
            if ( isEmpty )
                return true;
            for (const [key, value] of Object.entries( this.products )) {
                if ( value.delete )
                    deleteIds.push(value.id);
            }
            if ( deleteIds.length ) {
                axios.post("/delete-products", { product_id: deleteIds })
                    .then( (res) => {
                        this.getProducts();
                    })
            }
        },
        getProducts() {
            axios.get("/products")
                .then( (res) => {
                    this.products = res.data.entity;
                })
        },
        determineType(_index) {
            let data = JSON.parse(_index.value),
                text = "";
            switch(_index.type) {
                case '1':
                    text = `${data.size} MB`;
                    break;
                case '2':
                    text = `${data.height}x${data.width}x${data.lenght}`;
                    break;
                case '3':
                    text = `${data.weight}KG`;
                    break;
            }
            return text;
        }
    }
}
</script>