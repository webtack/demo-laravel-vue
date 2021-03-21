<template>
    <v-dialog
        v-model="dialog"
        width="500"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="blue"
                text
                v-bind="attrs"
                v-on="on"
            >
                <v-icon>mdi-plus</v-icon>
                Create news
            </v-btn>
        </template>

        <v-card>
            <v-card-title class="headline grey lighten-2">
                Creating news
            </v-card-title>
            <v-card-text>
                <news-form
                    :reset="dialog"
                    @submit="newsCreated"
                    @cancel="dialog = false"
                ></news-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import NewsForm from '@/components/NewsForm'

export default {
	name: 'NewsCreate',
    components: { NewsForm },
    data() {
		return {
			dialog: false
        }
    },
    methods: {
	    newsCreated() {
	    	this.dialog = false
	    	this.$emit('created')
        }
    }
}
</script>