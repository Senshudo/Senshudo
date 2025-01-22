export default () => {
    return {
        getUrl() {
            return typeof window !== 'undefined' ? new URL(window.location.href) : null
        },
        get(name: string) {
            return this.getUrl()?.searchParams.get(name)
        },
        set(name: string, value: string) {
            const url = this.getUrl()
            url?.searchParams.set(name, value)
            this.replace(url?.toString())
        },
        delete(name: string) {
            const url = this.getUrl()
            url?.searchParams.delete(name)
            this.replace(url?.toString())
        },
        replace(url?: string | null) {
            if (!url || typeof window === 'undefined') {
                return
            }

            window.history.replaceState({}, '', url)
        },
    }
}
