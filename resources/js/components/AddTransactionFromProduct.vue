<template>
<div id="wrapper">
    <div id="company-table">
        <table>
            <tr>
                <td>Name</td>
                <td>Type</td>
                <td>Quantity</td>                
                <td>Total</td>
                <td>Created At</td>
                <td>Company Profile</td>
            </tr>
            <tr v-bind:key="i" v-for="(company,i) in productCompanies">
                <td>{{company.name}}</td>
                <td>{{company.type}}</td>
                <td>{{company.quantity}}</td>
                <td>{{company.total}}</td>
                <td>{{company.created_at}}</td>
                <td><a :href="/get-company/+ company.id">Profile</a></td>
            </tr>
        </table>
    </div>
    <br>
    <div id="add-transaction-form">
        <h2>Add {{ product.name }} transaction to new Company</h2>
        <p><b>In Stock: {{ inStock }}</b></p>
        <p id="inStockMessage"> {{ inStockMessage }}</p>
        <form method='post' action="/add-transaction" @submit.prevent="submit">
            <select v-model="selected" @change="loadCompany">
                <option v-for="(company,i) in companies" v-bind:value="company.id" v-bind:key="i">
                    {{ company.name }}
                </option>
            </select>
            <label for="quantity">Quantity:</label>
            <input id='quantity' ref='quantity' name='quantity' type="text" @keydown="getQuantity" @change="updatePrice" v-model="quantity"/>
            <label for="price">Price:</label>
            <input id='price' name='price' type="text" v-model="price" readonly/>
            <label for="total">Total:</label>
            <input id='total' name='total' type="text" v-model="total"/>
            <br>
            <button :disabled="isDisabled()" @click="submit">Submit</button>
        </form>
    </div>
</div>
</template>

<script>
    import axios from 'axios';

    export default {
        data: function() {
            return {
                companies: [],
                product: {},
                productCompanies: [],
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
            this.loadCompanies();
            this.loadProduct();
            this.getProductCompanies()
        },

        methods: {
            loadProduct: function() {
                let $id = this.$attrs.product_id;
                axios.get('/ajax/get-product/' + $id)
                .then((response) => {
                    console.log(response.data)
                    this.product = response.data
                    })
                .catch(function(error) {
                    console.log('Error in product retrieval')
                });
            },

            loadCompanies: function() {
                axios.get('/all-companies/')
                .then((response) => {
                    this.companies = response.data
                    })
                .catch(function(error) {
                    console.log('Error in company retrieval')
                });
            },

            loadCompany: function(e) {
                let $id = e.target.value;
                axios.get('/ajax/get-company/' + $id)
                .then((response) => {
                    this.company = response.data;
                    this.quantity = this.$refs.quantity.value;
                    this.price = this.product.price;
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
                this.populateTable();
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

            getProductCompanies: function() {
                let id = this.$attrs.product_id;
                axios.get('/all-product-companies/' + id)
                .then((response) => {
                    this.productCompanies = response.data
                    this.loadCompanies()
                    })
                .catch(function(error) {
                    console.log('Error in company retrieval')
                });
            },

            populateTable: function() {
                this.getProductCompanies();
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
