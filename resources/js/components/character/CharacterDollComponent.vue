<template>
    <div class="card mb-2">
        <div class="card-header">
            {{character.name}}
            {{character.nickname}}
            {{character.last_name}}
        </div>
        <div class="card-body">
            <div class="row m-0 text-center align-items-center">
                <div class="col-12 col-lg-6">
                    <img :src="character.avatar.path" :alt="character.name" class="w-50 rounded-circle"/>
                </div>
                <div class="col-12 col-lg-6 character-doll">
                    <div class="row align-items-end">
                        <div class="col-2 p-2">
                            <div class="border" style="height: 50px;"></div>
                        </div>
                        <div class="col-2 p-2">
                            <div class="border" style="height: 50px;"></div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="border" style="height: 100px;"></div>
                        </div>
                        <div class="col-2 p-2">
                            <div class="border" style="height: 50px;"></div>
                        </div>
                        <div class="col-2 p-2">
                            <div class="border" style="height: 50px;"></div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-4 p-2">
                            <div class="border" style="height: 180px;"></div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="border" style="height: 180px;"></div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="border" style="height: 180px;"></div>
                        </div>
                    </div>
                    <div class="row align-items-start">
                        <div class="col-2 p-2">
                            <div class="border" style="height: 50px;"></div>
                        </div>
                        <div class="col-2 p-2">
                            <div class="border" style="height: 50px;"></div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="border" style="height: 100px;"></div>
                        </div>
                        <div class="col-2 p-2">
                            <div class="border" style="height: 50px;"></div>
                        </div>
                        <div class="col-2 p-2">
                            <div class="border" style="height: 50px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "character-doll-component",
        props: {
            character: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style>
    .character-doll {
        background: url('/img/character/dummy.png');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        height: 500px;
    }
</style>
