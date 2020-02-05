import {mount, shallowMount} from "@vue/test-utils"
import InfoWindow from "../components/InfoWindow"


describe('InfoWindow', () => {
    test('Is InfoWindow Vue Instance?', () => {
        const wrapper = mount(InfoWindow)

        expect(wrapper.isVueInstance()).toBeTruthy()
    })

    test('Test InfoWindow UI', () => {
        const wrapper = mount(InfoWindow, {
            propsData: {
                event: {
                    title: 'Test event',
                    description: 'test event descr',
                    started_at: '12-02-2020',
                    end_at: '17-02-2020'
                }
            }
        })

        const title = wrapper.find('h3')
        expect(title.text()).toBe('Test event')

        const descr = wrapper.find('p')
        expect(descr.text()).toBe('test event descr')

        const startTime = wrapper.findAll('span.time').at(0)
        const endTime = wrapper.findAll('span.time').at(1)
        expect(startTime.text()).toBe('Start at: 12-02-2020')
        expect(endTime.text()).toBe('End at: 17-02-2020')

        expect(wrapper.find('button').exists()).toBeTruthy()
    })

    test('Test tirgger click on button', () => {
        const wrapper = mount(InfoWindow, {
            propsData: {
                event: {
                    title: 'Test event',
                    description: 'test event descr',
                    started_at: '12-02-2020',
                    end_at: '17-02-2020'
                }
            }
        })

        const registerToEventStub = jest.fn()

        wrapper.setMethods({
            registerToEvent: registerToEventStub
        })

        wrapper.find('button').trigger('click')

        expect(registerToEventStub).toHaveBeenCalled()
    })
})
