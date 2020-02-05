import {shallowMount} from "@vue/test-utils"
import Place from "../components/Place"

describe('Place', () => {
    test('Place component render correctly price', () => {

        const wrapper = shallowMount(Place, {
            propsData: {
                place: {
                    position_y: 0,
                    position_x: 0,
                    price: 18.39,
                    reservation: null
                }
            }
        })

        const price = wrapper.find('div.place-body')

        expect(price.is('div')).toBeTruthy()

        expect(price.text()).toBe('18.39')

    })

    test('Place component render correctly logo', () => {
        const wrapper = shallowMount(Place, {
            propsData: {
                place: {
                    position_y: 0,
                    position_x: 0,
                    price: 18.39,
                    reservation: {
                        id: 1001,
                        place_id: 1001,
                        logo: 'http://localhost/storage/images/event_logos/1/AQrdnB3S.png'
                    }
                }
            }
        })

        const price = wrapper.find('div.place-body')
        expect(price.exists()).toBe(false)

        const img = wrapper.find('img')
        expect(img.attributes('src')).toBe('http://localhost/storage/images/event_logos/1/AQrdnB3S.png')
    })

    test('Click should be call handler', () => {
        const wrapper = shallowMount(Place, {
            propsData: {
                place: {
                    position_y: 0,
                    position_x: 0,
                    price: 18.39,
                    reservation: null
                }
            }
        })

        const onPlaceClickStub = jest.fn()

        wrapper.setMethods({
            onPlaceClick: onPlaceClickStub
        })

        wrapper.find('div.place-container')
            .trigger('click')

        expect(onPlaceClickStub).toHaveBeenCalled()
    })
})
