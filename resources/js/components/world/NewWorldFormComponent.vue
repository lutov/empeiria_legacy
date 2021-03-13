<template>
    <div>
        <label for="new_world_name">Create new World</label>
        <form action="/worlds" class="form-inline" method="POST">
            <input class="form-control form-control-sm mr-2" id="new_world_name" placeholder="New world's name"
                   v-model="new_world.name">
            <button class="btn btn-sm btn-success" v-on:click.prevent="storeWorld()">Create</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "new-world-form-component",
        props: {
            new_world: {
                type: Object
            }
        }
    }
</script>

<style scoped>

</style>
