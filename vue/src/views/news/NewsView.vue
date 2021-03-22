<template>
    <v-card
        tile
        flat
        :loading="loading"
    >
        <v-card-title>
            {{ item.title }}
            <v-btn
                v-if="item.slug"
                xSmall
                dark
                fab
                color="success"
                class="ml-3"
                :to="{name: 'news.edit', params: {slug: item.slug}}"
            >
                <v-icon>mdi-square-edit-outline</v-icon>
            </v-btn>
        </v-card-title>
        <v-card-text class="pa-5">
            <div>
                {{ item.body }}
            </div>
            <div class="mt-5">
                <h4>Tags</h4>
                <div class="mb-3">
                    You can see there is related tags
                </div>
                <hr class="my-3">
                <ul>
                    <li v-for="tag in tags">
                        <v-btn text :to="{name: 'tags.view', params: {slug: tag.slug}}">{{ tag.name }}</v-btn>
                    </li>
                </ul>
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
import {newsItem} from '@/api/news'
export default {
	name: 'NewsList',
    data() {
	    return {
	    	item: {},
	    	tags: [],
            loading: true
        }	
    },
    created() {
        this.fetchItem()
    },
    methods: {
		fetchItem() {
			newsItem(this.$route.params.slug)
                    .then(response => {
	                    this.item = response.data.item
	                    this.tags = response.data.tags
	                    this.loading = false
                    })
                    .catch(error => {
	                    this.loading = false
                    })
			
        }
    }
}
</script>