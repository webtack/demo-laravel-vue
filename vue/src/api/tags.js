import request from '@/utils/request'

export function tagsList() {
	return request({
		url: 'tags/list',
		method: 'get'
	})
}

export function tagsItem(slug) {
	return request({
		url: `tags/${slug}`,
		method: 'get'
	})
}

export function tagsItemExist(slug) {
	return request({
		url: `tags/${slug}/exist`,
		method: 'get'
	})
}

export function tagsUpdate(uuid, payload) {
	return request({
		url: `tags/${uuid}/update`,
		data: payload,
		method: 'post'
	})
}

export function tagsCreate(payload) {
	return request({
		url: `tags/create`,
		data: payload,
		method: 'put'
	})
}

export function tagsDelete(slug) {
	return request({
		url: `tags/${slug}/delete`,
		method: 'delete'
	})
}