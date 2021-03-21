<template>
    <v-card
        tile
        flat

    >
        <div class="pa-3 d-flex">
            <h3>Tags</h3>
            <v-spacer></v-spacer>
            <tag-create @created="tagCreated"></tag-create>
        </div>
        <hr class="px-3">
        <v-data-table
            :loading="loading"
            :headers="headers"
            :items="items"
            :items-per-page="5"
            class="elevation-1"
        >
            <template v-slot:item.name="{ item }">
                <router-link :to="{name: 'tags.view', params: {slug: item.slug}}">{{ item.name }}</router-link>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-btn
                    text
                    color="success"
                    :to="{name: 'tags.edit', params: {slug: item.slug}}"
                >
                    <v-icon class="mr-2">mdi-square-edit-outline</v-icon>
                    Edit
                </v-btn>
                <tag-delete
                    :name="item.name"
                    :slug="item.slug"
                    @deleted="tagDeleted"
                ></tag-delete>
            </template>
        </v-data-table>
    </v-card>
</template>

<script>
import {tagsList} from '@/api/tags'
import TagCreate from './TagCreate'
import TagDelete from './TagDelete'

export default {
	name: 'TagList',
	components: { TagCreate, TagDelete },
    data() {
	    return {
		    headers: [
			    { text: 'Id', value: 'id', width: 75 },
			    { text: 'Name', value: 'name' },
			    { text: 'Slug', value: 'slug' },
			    { value: 'actions', sortable: false, align: 'end'},
		    ],
	    	items: [],
            loading: true
        }	
    },
    created() {
        this.fetchList()
    },
    methods: {
		fetchList() {
			tagsList()
                    .then(response => {
	                    this.items = response.data.items
	                    this.loading = false
                    })
                    .catch(error => {
	                    console.log(error.response.data)
	                    this.loading = false
                    })
			
        },
	    tagCreated() {
		    this.fetchList()
	    },
	    tagDeleted() {
		    this.fetchList()
	    }
    }
}
</script>