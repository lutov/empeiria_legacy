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
                        <form :action="'/items/'+item.id" class="form-inline" method="POST">
                            <input name="_method" type="hidden" value="PUT">
                            <button class="btn btn-sm btn-outline-warning" v-on:click.prevent="updateItem(item.id)">
                                Edit
                            </button>
                        </form>
                    </td>
                    <td>
                        <form :action="'/items/'+item.id" class="form-inline" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-sm btn-outline-danger" v-on:click.prevent="destroyItem(item.id)">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <label for="new_item_name">Create new Item</label>
            <form action="/items" class="form-inline" method="POST">
                <input class="form-control form-control-sm mr-2" id="new_item_name" placeholder="New item's name"
                       v-model="new_item_name">
                <button class="btn btn-sm btn-success" v-on:click.prevent="storeItem()">Create</button>
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
                    this.items = await axios.post('/items/' + id, params);
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
                    this.items = await axios.delete('/items/' + id, params);
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
