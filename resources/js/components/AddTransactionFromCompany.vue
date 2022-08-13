<template>
<div id="wrapper">
    <div id="product-table">
        <table>
            <tr>
                <td>Name</td>
                <td>Type</td>                
                <td>Quantity</td>                
                <td>Total</td>
                <td>Created At</td>
                <td>Product Profile</td>
            </tr>
            <tr v-bind:key="i" v-for="(product,i) in companyProducts">
                <td>{{product.name}}</td>
                <td>{{product.type}}</td>
                <td>{{product.quantity}}</td>
                <td>€{{product.total}}</td>
                <td>{{product.created_at}}</td>
                <td><a :href="/get-product/+ product.id">Profile</a></td>
            </tr>
        </table>
    </div>
    <br>
    <div id="add-transaction-form">
        <h2>Add new product to {{ company.name }}</h2>
        <p>In Stock: {{ inStock }}</p>
        <p id="inStockMessage"> {{ inStockMessage }}</p>
        <form method='post' action="/add-transaction" @submit.prevent="submit">
            <select v-model="selected" @change="loadProduct">
                <option v-for="(product, i) in products" v-bind:value="product.id" v-bind:key="i">
                    {{ product.name }}
                </option>
            </select>
            <label for="quantity">Quantity:</label>
            <input id='quantity' ref='quantity' name='quantity' type="text" @keydown="getQuantity" @change="updatePrice" v-model="quantity"/>
            <label for="price">Price:</label>
            <input id='price' name='price' type="text" v-model="price" readonly/>
            <label for="total">Total:</label>
            <input id='total' name='total' type="text" v-model="total"/>
            <br>
            <button :disabled="isDisabled()" @click="submit" >Submit</button>
        </form>
    </div>
</div>
</template>

<script>
import axios from 'axios';

    export default {
        data: function() {
            return {
                products: [],
                company_id: '',
                product: {},
                companyProducts: [],
                inStock: 0,
                inStockMessage: '',
                time: '',
                price: '',
                quantity: 1,
                selected: '',
                total: 0
            }
        },
        mounted() {
            this.loadCompany();
            this.loadProducts();
            this.getCompanyProducts();
        },

        methods: {
            loadCompany: function() {
                let $id = this.$attrs.company_id;
                axios.get('/ajax/get-company/' + $id)
                .then((response) => {
                    this.company = response.data
                    })
                .catch(function(error) {
                    console.log('Error in company retrieval')
                });
            },

            loadProducts: function() {
                axios.get('/all-products')
                .then((response) => {
                    this.products = response.data
                    })
                .catch(function(error) {
                    console.log('Error in product retrieval')
                });
            },

            loadProduct: function(e) {
                let $id = e.target.value;
                axios.get('/ajax/get-product/' + $id)
                .then((response) => {
                    this.product = response.data;
                    this.quantity = this.$refs.quantity.value;
                    this.price = this.product.price
                    this.inStock = this.product.quantity_in_stock;
                    this.updatePrice();
                    })
                .catch(function(error) {
                    console.log('Error in company retrieval')
                });
            },

            updatePrice : function() {
                if (this.isDisabled()) {
                    this.inStockMessage = 'There is not enough items in stock or quantity isn\'t a number';
                } else {
                    this.inStockMessage = ''
                    this.total = (this.quantity * this.price).toFixed(2);         
                }
            },

            submit : function(e) {
                e.preventDefault();
                this.product.quantity_in_stock = this.product.quantity_in_stock - this.quantity
                this.inStock = this.product.quantity_in_stock
                this.saveTransaction()
                this.populateTable()
            },

            async saveTransaction() {
                axios.post('/save-transaction', {
                    	product: this.product.name,
                        company: this.company.name,
                        quantity: this.quantity,
                        price: this.total
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            getCompanyProducts: function() {
                let id = this.$attrs.company_id;
                axios.get('/all-company-products/' + id)
                .then((response) => {
                    this.companyProducts = response.data
                    this.loadProducts();
                    })
                .catch(function(error) {
                    console.log('Error in product retrieval')
                });
            },

            populateTable: function() {
                this.getCompanyProducts();
            },

            isDisabled: function() {
                return this.product.quantity_in_stock < this.quantity ||
                    isNaN(this.quantity) || 
                    isNaN(this.total)
            },

            getQuantity: function () {
					this.quantity = this.$refs.quantity.value;
				}
        }
    }
</script>
