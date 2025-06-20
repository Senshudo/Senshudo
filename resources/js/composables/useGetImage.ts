import { useIsWebpSupported } from '@/composables/useIsWebpSupported'
import { get } from 'lodash'

export function useGetImage(data: unknown, key: string): string {
    if (data) {
        if (useIsWebpSupported()) {
            return get(data, `${key}.conversions.0.url`, `${key}.url`)
        } else {
            return get(data, `${key}.url`)
        }
    }

    return ''
}
