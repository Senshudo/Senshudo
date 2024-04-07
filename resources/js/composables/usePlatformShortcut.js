import { useMagicKeys, whenever } from '@vueuse/core'

export function usePlatformShortcut(shortcut, callback) {
    const isMac = typeof navigator !== 'undefined' ? navigator.userAgent.includes('Mac OS') : false

    const { current } = useMagicKeys({
        passive: false,
        onEventFired(e) {
            if (
                ((!isMac && e.ctrlKey) || (isMac && e.metaKey)) &&
                e.key === shortcut &&
                e.type === 'keydown'
            ) {
                e.preventDefault()
            }
        },
    })

    whenever(
        () =>
            ((!isMac && current.has('control')) || (isMac && current.has('meta'))) &&
            current.has(shortcut),
        () => callback(),
    )
}
