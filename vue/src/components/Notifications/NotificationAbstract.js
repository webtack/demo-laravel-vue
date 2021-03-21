import _ from 'lodash'

export default class NotificationAbstract {
	
	constructor(options) {		
		this.options = {
			title: undefined,
			message: undefined,
			type: NotificationAbstract.type.success,
			autoplay: false,
			duration: 5 * 1000
		}
		
		this.$_boot(options)
		
		if(this.options.autoplay) {
			this.open()
		}
	}

	static type = {
		success: 'success',
		error: 'error',
		info: 'info',
		warning: 'warning',
		default: 'default'
	}
	
	$_defaultOptions() {
		return {}
	}
	
	$_boot(options) {
		this.options = _.merge(this.options, this.$_defaultOptions())
		this.options = _.merge(this.options, options)
	}
	
	open() {
		console.log(this.options)
	}
}