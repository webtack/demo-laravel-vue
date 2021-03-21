import request from '@/utils/request'

export function newsList() {
	return request({
		url: 'news/list',
		method: 'get'
	})
}

export function newsItem(slug) {
	return request({
		url: `news/${slug}`,
		method: 'get'
	})
}

export function newsUpdate(slug, payload) {
	return request({
		url: `news/${slug}/update`,
		data: payload,
		method: 'post'
	})
}

export function newsCreate(payload) {
	return request({
		url: `news/create`,
		data: payload,
		method: 'put'
	})
}

export function newsDelete(slug) {
	return request({
		url: `news/${slug}/delete`,
		method: 'delete'
	})
}