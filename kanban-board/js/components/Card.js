const Card = {
    template: `
        <div class="bg-neutral-100 rounded-sm px-2 py-1 shadow-sm space-y-1">
            <div class="space-x-1">
                <div
                 v-for="label in labels"
                 class="text-xs capitalize text-white py-px px-2 rounded-sm inline-block"
                 :class="parseLabelColor(label)"
                 
                >
                     {{ label.name }}
                </div>
                </div>
            <p>{{ content }}</p>
        </div>
    `,

    props: {
        content: String,
        labels: Array
    },


    methods: {
        parseLabelColor(label) {
            return [
                `bg-[${label.color}]`,
            ];
        }
    }
}

export default Card;