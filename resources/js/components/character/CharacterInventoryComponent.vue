<template>
    <div class="card mb-2">
        <div class="card-header">Inventory</div>
        <div class="card-body">
            <div class="row">
                <item-card-component v-for="item in items" v-bind:key="item.id"
                                     v-bind:item="item"></item-card-component>
            </div>
        </div>
    </div>
</template>

<script>
    import ItemCardComponent from "../items/ItemCardComponent";

    export default {
        name: "character-inventory-component",
        components: {
            "item-card-component": ItemCardComponent
        },
        props: {
            character: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                items: {},
            };
        },
        methods: {
            async fetchItems() {
                try {
                    // maybe get the inventory explicitly
                    // instead of using the character id as the equivalent of the inventory id
                    let result = await axios.get('/inventories/' + this.character.id + '/items');
                    this.items = result.data;
                } catch (error) {
                    console.error(error);
                }
            }
        },
        mounted() {
            this.fetchItems();
        }
    }
</script>

<style scoped>

</style>
