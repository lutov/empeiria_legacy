<template>
    <div class="card">
        <img class="card-img-top" :src="'/img/worlds/'+world.id+'.jpg'" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{world.id}} {{world.name}}</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
            <div class="btn-group btn-group-sm" role="group" aria-label="World Actions">
                <button type="button" class="btn btn-secondary" v-on:click.prevent="$emit('update-world', world)">Edit
                </button>
                <button type="button" class="btn btn-primary">Play</button>
                <button type="button" class="btn btn-danger" v-on:click.prevent="$emit('destroy-world', world)">Delete
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'world-card-component',
        props: {
            world: {
                type: Object
            }
        }
    }
</script>
