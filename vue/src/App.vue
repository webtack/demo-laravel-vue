<template>
    <v-app id="inspire">
        <v-app-bar
            app
            color="white"
            flat
        >
            <v-container class="py-0 fill-height">
                <h3 class="mr-10">Demo Laravel+Vue</h3>
                <v-btn
                    v-for="(link, index) in links"
                    :key="index"
                    link
                    :href="link.href"
                    :to="link.to"
                    text
                    class="mr-2"
                >
                    {{ link.title }}
                </v-btn>
            </v-container>
        </v-app-bar>

        <v-main class="grey lighten-3">
            <v-container>
                <v-row>
                    <v-col>
                        <v-sheet
                            min-height="70vh"
                        >
                            <router-view></router-view>
                        </v-sheet>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
export default {
	data() {
		return {
			links: [
				{
					to: { name: 'news.list' },
					title: 'News'
				},
				{
					to: { name: 'tags.list' },
					title: 'Tags'
				}
			],
        }
	},
}
</script>