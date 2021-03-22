<template>
    <v-card
        tile
        flat
    >        
        <v-card-text class="pa-0 mt-3">
            <v-form
                ref="form"
                v-model="isValid"
                :disabled="loading"
                lazy-validation
            >
                <v-text-field
                    v-model="title"
                    :rules="titleRules"
                    label="Title"
                    outlined
                    dense
                    required
                    @input="change"
                ></v-text-field>
                <v-textarea
                    v-model="body"
                    :rules="bodyRules"
                    label="Body"
                    outlined
                    dense
                    required
                    @input="change"
                ></v-textarea>
            </v-form>
            <div v-if="slug" class="mb-5 pa-3 tags">
                <news-tags-form
                    :tags="tags"
                    @change="addTag"
                    @delete="deleteTag"
                ></news-tags-form>
            </div>
        </v-card-text>        
        <v-card-actions class="pa-0">
            <v-btn
                :disabled="!actionDisabled"
                color="success"
                @click="submit"
            >
                Save
            </v-btn>
            <v-btn
                @click="cancel"
            >
                Cancel
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
import _ from 'lodash'
import {newsItem, newsUpdate, newsCreate} from '@/api/news'
import NewsTagsForm from './NewsTagsForm.vue'

export default {
	name: 'NewsForm',
    components: { NewsTagsForm },
	props: {
		reset: {
		    type: Boolean,
            default: false      
        },
		slug: {
			type: String,
			default: null
		}
	},
	data: () => ({
        loading: false,
		isValid: false,
		isChange: false,
		title: '',
		titleRules: [
			v => !!v || 'Title is required',
			v => (v && v.length >= 10) || 'Title must be more than 10 characters'
		],
		body: '',
		bodyRules: [
			v => !!v || 'Body is required'
		],
		tags: []
	}),
    computed: {
	    actionDisabled() {
	    	return this.isValid && this.isChange
        },
	    payload() {
		    return {
			    item: {
				    title: this.title,
				    body: this.body
                },
                tags: this.tags
		    }
	    }
    },
    watch: {
	    reset(value) {
	    	if(value) {
			    this.resetForm()
            }
        }
    },
    mounted() {
	    this.fetchItem()
    },
	methods: {
		fetchItem() {
			if(!this.slug) {
				this.resetForm()
				return
            }
			
			this.loading = true
            
			newsItem(this.slug)
					.then(response => {
						this.title = response.data.item.title
						this.body = response.data.item.body
						this.tags = response.data.tags
						this.loading = false
					})
					.catch(error => {
						this.loading = false
					})

		},
		change() {
			this.isChange = true
        },
		submit() {
			if(this.$refs.form.validate()) {
				if(this.slug) {
					this.update()
                } else {
					this.create()
                }
            }
		},
        update() {
	        this.loading = true
			
	        newsUpdate(this.slug, this.payload)
                    .then(response => {
	                    this.loading = false
                    	this.emitChangeEvent('submit')
                    })
        },
		create() {
			this.loading = true
            
			newsCreate(this.payload)
					.then(response => {
						this.loading = false
						this.emitChangeEvent('submit')
					})
		},
		addTag(item) {
			this.isChange = true
			this.tags.push(item)
		},
        deleteTag(uuid) {
	        this.isChange = true
			this.tags = _.filter(this.tags, o => { return o.uuid !== uuid})
        },
		cancel() {
			this.emitChangeEvent('cancel')
		},
		emitChangeEvent(event) {			
			this.$emit(event)
        },
        resetForm() {
	        this.$refs.form.resetValidation()
	        this.title = ''
	        this.body = ''
	        this.tags = []
        }
	}
}
</script>

<style lang="scss" scoped>
    .tags {
        border: rgba(0,0,0,0.38) solid 1px;
        border-radius: 4px;
    }
    
</style>