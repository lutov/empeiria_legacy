<template>
    <div class="mt-2">
        <label for="new_squad_name">Create new Squad</label>
        <form action="/squads" class="form-inline" method="POST">
            <input class="form-control form-control-sm mr-2" id="new_squad_name"
                   placeholder="New squad's name"
                   v-model="new_squad.name">
            <button class="btn btn-sm btn-success" v-on:click.prevent="storeSquad()">Create</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "new-squad-form-component",
        data() {
            return {
                new_squad: {
                    name: ''
                }
            };
        },
        methods: {
            defSquad() {
                this.new_squad = {
                    name: ''
                };
            },
            storeSquad() {
                this.$emit('store-squad', this.new_squad);
                this.defSquad();
            }
        }
    }
</script>

<style scoped>

</style>
