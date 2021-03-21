<template>
    <v-card
        tile
        flat
        
    >
        <div class="pa-3 d-flex">
            <h3>News</h3>
            <v-spacer></v-spacer>
            <news-create @created="newsCreated"></news-create>
        </div>
        <hr class="px-3">
        <v-data-table
            :loading="loading"
            :headers="headers"
            :items="items"
            :items-per-page="5"
            class="elevation-1"
        >
            <template v-slot:item.title="{ item }">
                <router-link :to="{name: 'news.view', params: {slug: item.slug}}">{{ item.title }}</router-link>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-btn
                    text
                    color="success"
                    :to="{name: 'news.edit', params: {slug: item.slug}}"
                >
                    <v-icon class="mr-2">mdi-square-edit-outline</v-icon>
                    Edit
                </v-btn>
                <news-delete
                    :title="item.title"
                    :slug="item.slug"
                    @deleted="newsDeleted"
                ></news-delete>
            </template>
        </v-data-table>
    </v-card>
</template>

<script>
import {newsList} from '@/api/news'
import NewsCreate from './NewsCreate'
import NewsDelete from './NewsDelete'

export default {
	name: 'NewsList',
    components: { NewsCreate, NewsDelete },
    data() {
	    return {
		    dialog: false,
		    headers: [
			    { text: 'Id', value: 'id', width: 75 },
			    { text: 'Title', value: 'title' },
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
			newsList()
                    .then(response => {
	                    this.items = response.data.items
	                    this.loading = false
                    })
                    .catch(error => {
	                    console.log(error.response.data)
	                    this.loading = false
                    })
			
        },
	    newsCreated() {
            this.fetchList()
        },
	    newsDeleted() {			
		    this.fetchList()
	    }
    }
}
</script>