<template>

    <v-card>
        <v-card-title>
            Squads
            <v-spacer></v-spacer>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
            ></v-text-field>
            <v-spacer></v-spacer>
            <v-dialog
                v-model="dialog"
                max-width="500px"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        color="primary"
                        dark
                        class="mb-2"
                        v-bind="attrs"
                        v-on="on"
                    >
                        New Item
                    </v-btn>
                </template>
                <v-card>
                    <v-card-title>
                        <span class="text-h5">{{ formTitle }}</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-text-field
                                        v-model="editedItem.name"
                                        label="Name"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-select
                                        v-model="editedItem.faction"
                                        :hint="`${factionSelect.name}, ${factionSelect.id}`"
                                        :items="factions"
                                        item-text="name"
                                        item-value="id"
                                        label="Faction"
                                        return-object
                                        single-line
                                    ></v-select>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="blue darken-1"
                            text
                            @click="close"
                        >
                            Cancel
                        </v-btn>
                        <v-btn
                            color="blue darken-1"
                            text
                            @click="save"
                        >
                            Save
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialogDelete" max-width="500px">
                <v-card>
                    <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                        <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-card-title>
        <v-data-table
            :headers="headers"
            :items="squads"
            :search="search"
        >
            <template v-slot:item.banner="{ item }">
                <v-avatar>
                    <img
                        :src=item.banner.path
                        :alt=item.name
                    >
                </v-avatar>
            </template>
            <template v-slot:item.name="{ item }">
                <a :href="'/squads/'+item.id">{{ item.name }}</a>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="editItem(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    @click="deleteItem(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
            <template v-slot:no-data>
                <v-btn
                    color="primary"
                    @click="fetchSquads"
                >
                    Reset
                </v-btn>
            </template>

        </v-data-table>
    </v-card>

</template>

<script>
    export default {
        name: 'squads-component',
        data() {
            return {
                api: {
                    squads: '/api/squads',
                    factions: '/api/factions'
                },
                dialog: false,
                dialogDelete: false,
                search: '',
                headers: [
                    {text: 'ID', value: 'id'},
                    {text: 'Banner', value: 'banner', sortable: false},
                    {
                        text: 'Name',
                        align: 'start',
                        filterable: true,
                        value: 'name',
                    },
                    {text: 'Faction', value: 'faction.name'},
                    {text: 'Actions', value: 'actions', sortable: false}
                ],
                squads: [],
                editedIndex: -1,
                editedItem: {
                    id: 0,
                    name: '',
                    faction: {}
                },
                defaultItem: {
                    id: 0,
                    name: '',
                    faction: {}
                },
                factionSelect: {},
                factions: []
            }
        },

        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Squad' : 'Edit Squad';
            },
        },

        watch: {
            dialog(val) {
                val || this.close();
            },
            dialogDelete(val) {
                val || this.closeDelete();
            },
        },

        methods: {

            async fetchSquads() {
                try {
                    axios.get(this.api.squads).then(response => this.squads = response.data);
                } catch (error) {
                    console.error(error);
                }
            },

            editItem(item) {
                this.editedIndex = this.squads.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog = true;
                this.factionSelect = this.editedItem.faction;
            },

            deleteItem(item) {
                this.editedIndex = this.squads.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialogDelete = true;
            },

            deleteItemConfirm() {
                let i = this.editedIndex;
                axios.delete(this.api.squads + '/' + this.editedItem.id, this.editedItem).then(response => {
                    this.editedItem = response.data;
                    this.squads.splice(i, 1);
                }).catch(error => console.log(error));
                this.closeDelete();
            },

            close() {
                this.avatarSelect = {};
                this.factionSelect = {};
                this.dialog = false;
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                })
            },

            closeDelete() {
                this.dialogDelete = false;
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                })
            },

            save() {
                if (this.editedIndex > -1) {
                    let i = this.editedIndex;
                    axios.put(this.api.squads + '/' + this.editedItem.id, this.editedItem).then(response => {
                        this.editedItem = response.data;
                        Object.assign(this.squads[i], this.editedItem);
                    }).catch(error => console.log(error));
                } else {
                    axios.post(this.api.squads, this.editedItem).then(response => {
                        this.editedItem = response.data;
                        this.squads.push(this.editedItem);
                    }).catch(error => console.log(error));
                }
                this.close();
            },

            async fetchFactions() {
                try {
                    axios.get(this.api.factions).then(response => this.factions = response.data);
                } catch (error) {
                    console.error(error);
                }
            },

        },

        mounted() {
            console.log('Squads Component mounted');
            this.fetchSquads();
            this.fetchFactions();
        }
    }
</script>
