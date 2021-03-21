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
                    v-model="name"
                    :rules="nameRules"
                    label="Title"
                    outlined
                    dense
                    required
                    @input="change"
                ></v-text-field>
                <v-text-field
                    :disabled="slug !== null"
                    v-model="slugLocal"
                    :rules="slugRules"
                    :error-messages="slugErrors"
                    label="Slug"
                    outlined
                    dense
                    required
                    @input="slugChange"
                ></v-text-field>
            </v-form>
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
import {tagsItem, tagsItemExist, tagsUpdate, tagsCreate} from '@/api/tags'

export default {
	name: 'TagForm',
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
		isExist: false,
		name: '',
		nameRules: [
			v => !!v || 'Title is required',
			v => (v && v.length >= 5) || 'Title must be more than 5 characters'
		],
        slugLocal: '',
		slugRules: [
			v => !!v || 'Slug is required',
			v => (v && v.length >= 5) || 'Slug must be more than 5 characters'
		],
		slugErrors: [
			
        ]
	}),
    computed: {
	    actionDisabled() {
	    	return this.isValid && this.isChange
        },
	    payload() {
		    return {
			    name: this.name,
			    slug: this.slugLocal
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
            
			tagsItem(this.slug)
					.then(response => {
						this.name = response.data.item.name
						this.slugLocal = response.data.item.slug
						this.loading = false
					})
					.catch(error => {
						console.log(error.response.data)
						this.loading = false
					})

		},
		change() {
			this.isChange = true			
        },
		slugChange() {
			this.isChange = true
			this.slugErrors = []
			this.$refs.form.resetValidation()
        },
		submit() {
			if(this.$refs.form.validate()) {
				this.loading = true
                
				if(this.slug) {
					this.update()
                } else {
					this.create()
                }
            }
		},
        update() {
	        tagsUpdate(this.slug, this.payload)
                    .then(response => {
	                    this.loading = false
                    	this.emitChangeEvent('submit')
                    })
        },
		create() {

			tagsItemExist(this.payload.slug)
					.then(response => {
						const item = response.data.item
						const isExist = item ? true : false
                        
						if(isExist) {
							this.loading = false
							this.slugErrors.push('Tag\'s slug already exist')
						} else {
							this.slugErrors = []
                            this.createTag()
						}
					})
		},
        createTag() {
	        this.loading = true
            
	        tagsCreate(this.payload)
			        .then(response => {
				        this.loading = false
				        this.emitChangeEvent('submit', response.data.item)
			        })
        },
		cancel() {
			this.emitChangeEvent('cancel')
		},
		emitChangeEvent(event, payload) {
			this.$emit(event, payload)
        },
        resetForm() {
	        this.$refs.form.resetValidation()
	        this.name = ''
	        this.slugLocal = ''
	        this.slugErrors = []
	        this.loading = false
        }
	}
}
</script>