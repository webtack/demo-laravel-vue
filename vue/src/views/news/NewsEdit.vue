<template>
    <div v-if="$route.params.slug" class="pa-5">
        <div class="d-flex align-center">
            <h3>Editing news</h3>
            <v-btn dark fab xSmall color="blue" :to="{name: 'news.view', params: {slug: $route.params.slug}}" class="ml-3">
                <v-icon>mdi-eye</v-icon>
            </v-btn>
        </div>
        <news-form
            :slug="$route.params.slug"
            @cancel="$router.go(-1)"
        ></news-form>
    </div>

</template>

<script>
import NewsForm from '@/components/NewsForm'

export default {
	name: 'NewsEdit',
	components: { NewsForm }
}
</script>
