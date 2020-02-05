import { mount } from "@vue/test-utils"
import App from "../components/App"

describe('App', () => {
    test('Is App a vue instance?', () => {
        const wrapper = mount(App, {
            stubs: ['router-view']
        })

        expect(wrapper.isVueInstance()).toBeTruthy()
    })

    test('Is App render container as div?', () => {
        const wrapper = mount(App, {
            stubs: ['router-view']
        })

        const el = wrapper.find('.container')
        expect(el.is('div')).toBe(true)

    })
})
