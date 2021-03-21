import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

const routes = [
	{
		path: '/dashboard',
		name: 'home',
		component: Home
	},
	{
		path: '/about',
		name: 'About',
		// route level code-splitting
		// this generates a separate chunk (about.[hash].js) for this route
		// which is lazy-loaded when the route is visited.
		component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
	},
	{
		path: '/news/list',
		name: 'news.list',
		component: () => import('@/views/news/NewsList.vue')
	},
	{
		path: '/news/:slug',
		name: 'news.view',
		component: () => import('@/views/news/NewsView.vue')
	},
	{
		path: '/news/:slug/edit',
		name: 'news.edit',
		component: () => import('@/views/news/NewsEdit.vue')
	},
	{
		path: '/tags/list',
		name: 'tags.list',
		component: () => import('@/views/tags/TagList.vue')
	},
	{
		path: '/tags/:slug',
		name: 'tags.view',
		component: () => import('@/views/tags/TagView.vue')
	},
	{
		path: '/tags/:slug/edit',
		name: 'tags.edit',
		component: () => import('@/views/tags/TagEdit.vue')
	}
]

const router = new VueRouter({
	mode: 'history',
	base: process.env.BASE_URL,
	routes
})

export default router
