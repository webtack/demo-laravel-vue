<template>
    <v-card
        tile
        flat
        :loading="loading"
    >
        <v-card-title>
            {{ item.name }}
            <v-btn
                v-if="item.slug"
                xSmall
                dark
                fab
                color="success"
                class="ml-3"
                :to="{name: 'tags.edit', params: {slug: item.slug}}"
            >
                <v-icon>mdi-square-edit-outline</v-icon>
            </v-btn>
        </v-card-title>
        <hr>
        <v-card-text class="pa-5">
            <div class="mb-3">
                You can see there is related news
            </div>
            <ul>
                <li v-for="newsItem in news">
                    <v-btn text :to="{name: 'news.view', params: {slug: newsItem.slug}}">{{ newsItem.title }}</v-btn>
                </li>
            </ul>
        </v-card-text>
    </v-card>
</template>

<script>
import {tagsItem} from '@/api/tags'
export default {
	name: 'TagView',
    data() {
	    return {
	    	item: [],
	    	news: [],
            loading: true
        }	
    },
    created() {
        this.fetchItem()
    },
    methods: {
		fetchItem() {
			tagsItem(this.$route.params.slug)
                    .then(response => {
	                    this.item = response.data.item
	                    this.news = response.data.news
	                    this.loading = false
                    })
                    .catch(error => {
	                    console.log(error.response.data)
	                    this.loading = false
                    })
			
        }
    }
}
</script>