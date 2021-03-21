<template>
    <div v-if="$route.params.slug" class="pa-5">
        <div class="d-flex align-center">
            <h3>Editing tag</h3>
            <v-btn dark fab xSmall color="blue" :to="{name: 'tags.view', params: {slug: $route.params.slug}}" class="ml-3">
                <v-icon>mdi-eye</v-icon>
            </v-btn>
        </div>
        <tag-form
            :slug="$route.params.slug"
            @cancel="$router.go(-1)"
        ></tag-form>
    </div>

</template>

<script>
import TagForm from '@/components/TagForm'

export default {
	name: 'TagEdit',
	components: { TagForm }
}
</script>
