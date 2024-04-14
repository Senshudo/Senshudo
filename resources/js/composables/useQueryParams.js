export default () => {
    return {
        getUrl() {
            return typeof window !== 'undefined' ? new URL(window.location.href) : null
        },
        get(name) {
            return this.getUrl()?.searchParams.get(name)
        },
        set(name, value) {
            const url = this.getUrl()
            url?.searchParams.set(name, value)
            this.replace(url)
        },
        delete(name) {
            const url = this.getUrl()
            url?.searchParams.delete(name)
            this.replace(url)
        },
        replace(url) {
            if (!url || typeof window === 'undefined') {
                return
            }

            window.history.replaceState({}, '', url)
        },
    }
}
