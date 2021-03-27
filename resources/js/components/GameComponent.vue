<template>
    <div class="container-fluid">
        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <worlds-component></worlds-component>
            </div>
        </div>
    </div>
</template>

<script>
    import WorldsComponent from "./worlds/WorldsComponent";

    export default {
        name: "GameComponent",
        components: {
            'worlds-component': WorldsComponent
        }
    }
</script>

<style>

</style>
