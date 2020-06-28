<template>

    <div class="card">
        <div class="card-header">Items</div>

        <div class="card-body">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in items.data">
                    <td>{{item.id}}</td>
                    <td>{{item.name}}</td>
                    <td>
                        <form :action="'/items/'+item.id" method="POST" class="form-inline">
                            <input type="hidden" name="_method" value="PUT">
                            <button v-on:click.prevent="updateItem(item.id)" class="btn btn-sm btn-outline-warning">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form :action="'/items/'+item.id" method="POST" class="form-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <button v-on:click.prevent="destroyItem(item.id)" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <label for="new_item_name">Create new Item</label>
            <form action="/items" method="POST" class="form-inline">
                <input v-model="new_item_name" placeholder="New item's name" class="form-control form-control-sm mr-2" id="new_item_name">
                <button v-on:click.prevent="storeItem()" class="btn btn-sm btn-success">Create</button>
            </form>

        </div>
    </div>

</template>

<script>
    export default {
        name: 'items-component',
        data() {
            return {
                items: {},
                new_item_name: ''
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

            async storeItem() {

                let params = {
                    name: this.new_item_name
                };

                try {
                    this.items = await axios.post('/items', params);
                    this.new_item_name = '';
                    this.fetchItems();
                } catch (error) {
                    console.error(error);
                }

            },

            async updateItem(id) {

                let params = {
                    id: id
                };

                try {
                    this.items = await axios.post('/items/'+id, params);
                    this.fetchItems();
                } catch (error) {
                    console.error(error);
                }

            },

            async destroyItem(id) {

                let params = {
                    id: id
                };

                try {
                    this.items = await axios.delete('/items/'+id, params);
                    this.fetchItems();
                } catch (error) {
                    console.error(error);
                }

            }

        },
        mounted() {
            console.log('Items Component mounted');
            this.fetchItems();
        }
    }
</script>
