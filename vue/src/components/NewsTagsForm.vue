<template>
    <div>
        <div class="mb-3">
            <h3>Tags</h3>            
        </div>
        <v-divider class="mb-3" />
        <ul>
            <li
                v-for="(tag) in tags"
                :key="tag.uuid"
            >
                <div class="d-flex align-center justify-space-between pa-1">
                    <router-link :to="{name: 'tags.view', params: {slug: tag.slug}}">
                        {{ tag.name }}
                    </router-link>
                    <v-btn color="error" icon @click="deleteTag(tag.uuid)">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </div>
                <v-divider/>
            </li>
        </ul>
        <div v-if="isSelect" class="add-tag-form mt-5 d-flex align-center justify-center">
            <div>
                <v-select
                    :items="selectItems"
                    item-text="name"
                    item-value="uuid"
                    hide-details
                    label="Select tag"
                    outlined
                    dense
                    @change="change"
                ></v-select>
            </div>
            <div class="ml-3">
                <tag-create v-if="isSelect" @created="tagCreated"></tag-create>
            </div>
        </div>
    </div>

</template>

<script>
import _ from 'lodash'
import {tagsList} from '@/api/tags'
import TagCreate from '@/views/tags/TagCreate'

export default {
	name: 'NewsTagsForm',
	components: { TagCreate },
	props: {
		tags: {
			type: Array,
			required: true
		}
	},
	computed: {
		selectItems() {
			return _.filter(this.tagList, item => {
				const existedTag = _.find(this.tags, ['uuid', item.uuid])
                return !existedTag
			})
        },
    },
    watch: {
	    tags(collection) {
	    	this.isSelect = collection.length < 3
        }	
    },
	data() {
		return {
			isSelect: false,
			tagList: []
		}
	},
    created() {
	    this.fetchAllTags()	
    },
    methods: {
		fetchAllTags() {
			tagsList()
                    .then(response => {
                    	this.tagList = response.data.items
                    })
        },
	    tagCreated(item) {
		    this.fetchAllTags()
		    this.$emit('change', item)
	    },
        change(uuid) {
			this.isSelect = false
	        this.$emit('change', _.find(this.tagList, ['uuid', uuid]))
        },
        deleteTag(uuid) {
	        this.$emit('delete', uuid)
        }
    }
}
</script>

<style lang="scss" scoped="">
    .add-tag-form {
        /*border: rgba(0,0,0,0.38) solid 1px;*/
        /*border-radius: 4px;*/
    }
</style>