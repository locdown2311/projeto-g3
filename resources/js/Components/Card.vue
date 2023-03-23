<template>
    <div class="card w-96 bg-base-100 shadow-xl">
      <div class="card-body">
        <h2 class="card-title">
            <slot name="title"></slot>
        </h2>
        <p>
            <slot name="content"></slot>
        </p>
      </div>
    </div>
</template>