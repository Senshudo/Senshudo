export default function useFormatNumber(value, options) {
    return Intl.NumberFormat(
        typeof navigator !== 'undefined' ? navigator.language : 'en-GB',
        options,
    ).format(value)
}
