export function useIsWebpSupported(): boolean {
    if (usePage().props.isWebpSupported) {
        return true
    }

    if (typeof document !== 'undefined') {
        const elem = document.createElement('canvas')

        if (!!elem.getContext && elem.getContext('2d')) {
            const result = elem.toDataURL('image/webp').indexOf('data:image/webp') == 0

            elem.remove()

            return result
        }
    }

    return false
}
