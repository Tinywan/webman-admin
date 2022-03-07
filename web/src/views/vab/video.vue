<template>
	<el-main>
		<el-row :gutter="15">
			<el-col :lg="12">
				<el-card shadow="never" header="MP4点播">
					<sc-video
						ref="mp4"
						src="https://cdn.jsdelivr.net/gh/scuiadmin/CDN/video/scui-player-demo-1080.mp4"
						poster="https://cdn.jsdelivr.net/gh/scuiadmin/CDN/video/scui-player-demo-1080_Moment.jpg"
						:resource="resource"
						:danmu="danmu"
						:progressDot="progressDot"
						pip
					></sc-video>
					<div style="margin-top: 15px;">
						<el-form inline>
							<el-form-item>
								<el-select v-model="mode" placeholder="Select">
									<el-option label="默认" value="scroll"></el-option>
									<el-option label="顶部" value="top"></el-option>
									<el-option label="底部" value="bottom"></el-option>
								</el-select>
							</el-form-item>
							<el-form-item>
								<el-input v-model="input" placeholder="Please input" />
							</el-form-item>
							<el-form-item>
								<el-button type="primary" @click="sendComment">发送弹幕</el-button>
							</el-form-item>
						</el-form>
					</div>
				</el-card>
			</el-col>
			<el-col :lg="12">
				<el-card shadow="never" header="HlS(m3u8)直播">
					<sc-video
						src="http://cctvalih5ca.v.myalicdn.com/live/cctv5_2/index.m3u8"
						isLive
					></sc-video>
				</el-card>
			</el-col>
		</el-row>
	</el-main>
</template>

<script>
	import scVideo from '@/components/scVideo'

	export default {
		name: 'scvideo',
		components: {
			scVideo
		},
		data() {
			return {
				input: '',
				mode: 'scroll',
				resource: [
					{name: '720P', url: 'https://cdn.jsdelivr.net/gh/scuiadmin/CDN/video/scui-player-demo-720.mp4'},
					{name: '1080P', url: 'https://cdn.jsdelivr.net/gh/scuiadmin/CDN/video/scui-player-demo-1080.mp4'}
				],
				progressDot: [
					{time: 3, text: '标记文字'}
				],
				danmu: [
					{
						id: '1',
						start: 3000,
						txt: 'SCUI VIDEO DEMO'
					},
					{
						id: '2',
						start: 3000,
						txt: '一键三连，下次一定'
					}
				]
			}
		},
		mounted() {

		},
		methods: {
			sendComment(){
				if(this.$refs.mp4.player.danmu && this.input){
					this.$refs.mp4.player.danmu.sendComment({
						id: 'newId' + new Date().getTime(),
						start: this.$refs.mp4.player.currentTime*1000,
						txt: this.input,
						mode: this.mode
					})
					this.input = ''
				}

			}
		}
	}
</script>

<style>
</style>