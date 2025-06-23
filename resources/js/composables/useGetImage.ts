import placeholderPng from '@/../images/placeholder.png'
import placeholderWebp from '@/../images/placeholder.webp'
import { useIsWebpSupported } from '@/composables/useIsWebpSupported'
import { get } from 'lodash'

export function useGetImage(data: unknown, key: string): string | undefined {
    if (data) {
        if (useIsWebpSupported()) {
            return get(data, `${key}.conversions.0.url`, get(data, `${key}.url`, placeholderWebp))
        } else {
            return get(data, `${key}.url`, placeholderPng)
        }
    }

    return undefined
}
