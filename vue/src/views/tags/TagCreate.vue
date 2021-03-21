<template>
    <v-dialog
        v-model="dialog"
        width="500"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="blue"
                dark
                text
                v-bind="attrs"
                v-on="on"
            >
                <v-icon>mdi-plus</v-icon>
                Create tag
            </v-btn>
        </template>

        <v-card>
            <v-card-title class="headline grey lighten-2">
                Creating tag
            </v-card-title>
            <v-card-text>
                <tag-form
                    :reset="dialog"
                    @submit="tagsCreated"
                    @cancel="dialog = false"
                ></tag-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import TagForm from '@/components/TagForm'

export default {
	name: 'TagCreate',
    components: { TagForm },
    data() {
		return {
			dialog: false
        }
    },
    methods: {
	    tagsCreated(item) {
	    	this.dialog = false
	    	this.$emit('created', item)
        }
    }
}
</script>