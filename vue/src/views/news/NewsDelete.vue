<template>
    <v-dialog
        v-model="dialog"
        :disabled="disabled"
        width="500"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                text
                color="error"
                @click="dialog = true"
            >
                <v-icon class="mr-2">mdi-delete</v-icon>
                Delete
            </v-btn>
        </template>

        <v-card>
            <v-card-title class="headline grey lighten-2">
                Deleteing {{ title }}
            </v-card-title>
            <v-card-text class="pt-5">
                Do you really want to delete the item?
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="error"
                    text
                    @click="newsDelete"
                >
                    Delete
                </v-btn>
                <v-btn
                    text
                    @click="dialog = false"
                >
                    Cancel
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {newsDelete} from '@/api/news'

export default {
	name: 'NewsDelete',
	props: ['title', 'slug'],
	data() {
		return {
			dialog: false,
			disabled: false
		}
	},
	methods: {
		newsDelete() {
			this.disabled = true
            
			newsDelete(this.slug)
					.then(response => {
						this.$emit('deleted')
						this.dialog = false
					})
					.catch(error => {
						this.dialog = false
					})


		}
	}
}
</script>