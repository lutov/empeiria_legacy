<template>

    <v-card>
        <v-card-title>
            Characters
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
                                    <v-text-field
                                        v-model="editedItem.nickname"
                                        label="Nickname"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-text-field
                                        v-model="editedItem.last_name"
                                        label="Last Name"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-text-field
                                        v-model="editedItem.age"
                                        label="Age"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-select
                                        v-model="editedItem.gender"
                                        :hint="`${genderSelect.name}, ${genderSelect.id}`"
                                        :items="genders"
                                        item-text="name"
                                        item-value="id"
                                        label="Gender"
                                        return-object
                                        single-line
                                    ></v-select>
                                </v-col>
                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                >
                                    <v-select
                                        v-model="editedItem.avatar"
                                        :hint="`${avatarSelect.name}, ${avatarSelect.id}`"
                                        :items="avatars"
                                        item-text="name"
                                        item-value="id"
                                        label="Avatar"
                                        return-object
                                        single-line
                                    >
                                        <template v-slot:selection="{ item, index }">
                                            {{ item.name }}
                                        </template>
                                        <template v-slot:item="{ item }">
                                            <v-avatar><img :src=item.path :alt=item.name></v-avatar>
                                            {{ item.name }}
                                        </template>
                                    </v-select>
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
            :items="characters"
            :search="search"
        >
            <template v-slot:item.avatar="{ item }">
                <v-avatar>
                    <img
                        :src=item.avatar.path
                        :alt=item.name
                    >
                </v-avatar>
            </template>
            <template v-slot:item.name="{ item }">
                <a :href="'/characters/'+item.id">{{ item.name }}</a>
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
                    @click="fetchCharacters"
                >
                    Reset
                </v-btn>
            </template>

        </v-data-table>
    </v-card>

</template>

<script>
    export default {
        name: 'characters-component',
        data() {
            return {
                api: {
                    characters: '/api/characters',
                    avatars: '/api/avatars/random',
                    genders: '/api/genders'
                },
                dialog: false,
                dialogDelete: false,
                search: '',
                headers: [
                    {text: 'ID', value: 'id'},
                    {text: 'Avatar', value: 'avatar', sortable: false},
                    {
                        text: 'Name',
                        align: 'start',
                        filterable: true,
                        value: 'name',
                    },
                    {
                        text: 'Nickname',
                        align: 'start',
                        filterable: true,
                        value: 'nickname',
                    },
                    {
                        text: 'Last Name',
                        align: 'start',
                        filterable: true,
                        value: 'last_name',
                    },
                    {text: 'Age', value: 'age'},
                    {text: 'Gender', value: 'gender.name'},
                    {text: 'Actions', value: 'actions', sortable: false}
                ],
                characters: [],
                editedIndex: -1,
                editedItem: {
                    id: 0,
                    name: '',
                    nickname: '',
                    last_name: '',
                    age: 0,
                    gender: {},
                    avatar: {}
                },
                defaultItem: {
                    id: 0,
                    name: '',
                    nickname: '',
                    last_name: '',
                    age: 0,
                    gender: {},
                    avatar: {}
                },
                avatarSelect: {},
                avatars: [],
                genderSelect: {},
                genders: []
            }
        },

        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Character' : 'Edit Character';
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

            async fetchCharacters() {
                try {
                    axios.get(this.api.characters).then(response => this.characters = response.data);
                } catch (error) {
                    console.error(error);
                }
            },

            editItem(item) {
                this.editedIndex = this.characters.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog = true;
                this.avatarSelect = this.editedItem.avatar;
                this.genderSelect = this.editedItem.gender;
                this.fetchAvatars();
            },

            deleteItem(item) {
                this.editedIndex = this.characters.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialogDelete = true;
            },

            deleteItemConfirm() {
                let i = this.editedIndex;
                axios.delete(this.api.characters + '/' + this.editedItem.id, this.editedItem).then(response => {
                    this.editedItem = response.data;
                    this.characters.splice(i, 1);
                }).catch(error => console.log(error));
                this.closeDelete();
            },

            close() {
                this.avatarSelect = {};
                this.genderSelect = {};
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
                    axios.put(this.api.characters + '/' + this.editedItem.id, this.editedItem).then(response => {
                        this.editedItem = response.data;
                        Object.assign(this.characters[i], this.editedItem);
                    }).catch(error => console.log(error));
                } else {
                    axios.post(this.api.characters, this.editedItem).then(response => {
                        this.editedItem = response.data;
                        this.characters.push(this.editedItem);
                    }).catch(error => console.log(error));
                }
                this.close();
            },

            async fetchAvatars() {
                try {
                    axios.get(this.api.avatars, {params: this.editedItem.gender}).then(response => this.avatars = response.data);
                } catch (error) {
                    console.error(error);
                }
            },

            async fetchGenders() {
                try {
                    axios.get(this.api.genders).then(response => this.genders = response.data);
                } catch (error) {
                    console.error(error);
                }
            },

        },

        mounted() {
            console.log('Characters Component mounted');
            this.fetchCharacters();
            this.fetchGenders();
        }
    }
</script>
