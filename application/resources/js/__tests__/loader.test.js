import { mount } from "@vue/test-utils"
import Loader from "../components/Loader"

describe('Loader', () => {
    test('Is Loader a vue instance?', () => {
        const wrapper = mount(Loader)

        expect(wrapper.isVueInstance()).toBeTruthy()
    })

    test('Is Loader render container as div?', () => {
        const wrapper = mount(Loader)

        const el = wrapper.find('.loader-container')
        expect(el.is('div')).toBe(true)

    })
})
