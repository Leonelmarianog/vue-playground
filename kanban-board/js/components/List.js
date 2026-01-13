const List = {
    template: `
        <div class="bg-neutral-300 rounded-md shadow-sm">
             <div class="px-4 py-2">
                 <h2 class="font-bold capitalize">{{ title }}</h2>
             </div>
    
             <div class="px-2 pb-2 space-y-4">
                 <ul class="space-y-2">
                     <li v-for="card in cards">
                         <div class="bg-neutral-100 rounded-sm px-2 py-1 shadow-sm space-y-1">
                             <div class="space-x-1">
                                 <div
                                     v-for="label in card.labels"
                                     class="text-xs capitalize text-white py-px px-2 rounded-sm inline-block"
                                     :class="parseLabelColor(label)"
                                     
                                 >
                                     {{ label.name }}
                                 </div>
                             </div>
                             <p>{{ card.content }}</p>
                         </div>
                     </li>    
                 </ul>
    
                 <button class="font-bold text-sm text-neutral-500 cursor-pointer hover:text-neutral-700">+
                     Add another card
                 </button>
             </div>
        </div>
    `,

    props: {
        title: String,
        cards: Array
    },

    methods: {
        parseLabelColor(label) {
            return [
                `bg-[${label.color}]`,
            ];
        }
    }
}

export default List;
