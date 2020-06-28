<template>

    <div class="card">
        <div class="card-header">Inventory {{inventoryId}}</div>

        <div class="card-body">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in inventoryItems.data">
                    <td>{{item.id}}</td>
                    <td>{{item.name}}</td>
                    <td>
                        <form :action="'/inventories/'+inventoryId+'/items/detach'" method="POST" class="form-inline">
                            <button v-on:click.prevent="detachItems([item.id])" class="btn btn-sm btn-outline-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <label for="new_items">Add Items</label>
            <form :action="'/inventories/'+inventoryId+'/items/attach'" method="POST">
                <select class="form-control form-control-sm mr-2" id="new_items" v-model="newItems" :multiple="true">
                    <option v-for="item in items.data" :value="item.id">{{item.name}}</option>
                </select>
                <button v-on:click.prevent="attachItems()" class="btn btn-sm btn-success">Add</button>
            </form>

        </div>
    </div>

</template>

<script>
    export default {
        name: 'inventory-component',
        data() {
            return {
                inventoryId: 1,
                items: {},
                inventoryItems: {},
                newItems: []
            };
        },
        methods: {

            async fetchItems() {
                try {
                    this.items = await axios.get('/items');
                } catch (error) {
                    console.error(error);
                }
            },

            async fetchInventoryItems() {
                try {
                    this.inventoryItems = await axios.get('/inventories/'+this.inventoryId+'/items');
                } catch (error) {
                    console.error(error);
                }
            },

            async attachItems() {
                let params = {
                    items: this.newItems
                };
                try {
                    this.items = await axios.post('/inventories/'+this.inventoryId+'/items/attach', params);
                    this.fetchInventoryItems();
                    this.newItems = [];
                    this.fetchItems();
                } catch (error) {
                    console.error(error);
                }
            },

            async detachItems(items) {
                let params = {
                    items: items
                };
                try {
                    this.items = await axios.post('/inventories/'+this.inventoryId+'/items/detach', params);
                    this.fetchInventoryItems();
                    this.newItems = [];
                    this.fetchItems();
                } catch (error) {
                    console.error(error);
                }
            }

        },
        mounted() {
            console.log('Inventory Component mounted');
            this.fetchItems();
            this.fetchInventoryItems();
        }
    }
</script>
