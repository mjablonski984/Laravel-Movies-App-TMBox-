module.exports = {
  theme: {
    fontFamily: {
      'sans': ["Lato", "ui-sans-serif", "system-ui", "-apple-system","Roboto", "BlinkMacSystemFont", "Segoe UI",  "Helvetica Neue", "Arial", "Noto Sans", "sans-serif"]
    },
    extend: {
        width: {
            '96': '24rem',
        },
        height: {
            '18': '4.5rem',
        },
        maxHeight: {
          'xs': '20rem',
          'sm': '24rem',
          'md': '28rem',
          'lg': '32rem',
          'xl': '36rem',
        },
        maxWidth: {
          '64': '16rem',

        },
    },
    spinner: (theme) => ({
      default: {
        color: '#dae1e7', // color you want to make the spinner
        size: '1em', // size of the spinner (used for both width and height)
        border: '2px', // border-width of the spinner (shouldn't be bigger than half the spinner's size)
        speed: '500ms', // the speed at which the spinner should rotate
      },
    }),
  },
  variants: {},
  plugins: [
      require('tailwindcss-spinner')(),
  ],
}
