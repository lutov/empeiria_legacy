<template>
    <div class="card mb-2">
        <div class="card-header">Inventory</div>
        <div class="card-body">
            <draggable class="row draggable" :list="items" group="squad" tag="div"
                       @sort="sort">
                <item-card-component v-for="item in items" v-bind:key="item.id"
                                     v-bind:item="item"></item-card-component>
            </draggable>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable';
    import ItemCardComponent from "../items/ItemCardComponent";

    export default {
        name: "character-inventory-component",
        components: {
            draggable,
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
                api: {
                    inventories: '/api/inventories'
                },
                items: [],
            };
        },
        methods: {
            async fetchItems() {
                try {
                    let result = await axios.get(this.api.inventories + '/' + this.character.inventory.id + '/items');
                    this.items = result.data;
                } catch (error) {
                    console.error(error);
                }
            },
            change: function (evt) {
                //console.log(evt);
            },
            //start, end, add, update, sort, remove all get the same
            start: function (evt) {
                //console.log(evt.item._underlying_vm_);
            },
            sort: function (evt) {
                //console.log(evt);
                let oldItem = this.items[evt.oldIndex];
                oldItem.sort = evt.oldIndex + 1;
                let item = this.items[evt.newIndex];
                item.sort = evt.newIndex + 1;
                let itemsPath = this.api.inventories + '/' + this.character.inventory.id + '/items';
                axios.put(itemsPath + '/' + oldItem.id, oldItem).then(response => {
                    axios.put(itemsPath + '/' + item.id, item).then(response => {
                        this.fetchItems();
                    }).catch(error => console.log(error));
                }).catch(error => console.log(error));
            },
            end: function (evt) {
                //console.log(evt.item._underlying_vm_);
                //console.log(evt.oldIndex);
                //console.log(evt.from);
                //console.log(evt.newIndex);
                //console.log(evt.to);
            },
            move: function (evt, originalEvent) {
                //console.log(evt)
                //console.log(originalEvent) //Mouse position
            }
        },
        mounted() {
            this.fetchItems();
        }
    }
</script>

<style scoped>

</style>
